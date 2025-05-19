<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\HousesRelationManager;
use App\Models\House;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Group::make()
                    ->columnSpan(2)
                    ->schema([
                        Forms\Components\Section::make('Primary Information')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('phone_number')
                                    ->required()
                                    ->numeric()
                                    ->maxLength(11),
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('password')
                                    ->password()
                                    ->rule(Password::default())
                                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->required(fn (string $context) => $context === 'create')
                                    ->maxLength(255),
                                TextInput::make('password_confirmation')
                                    ->password()
                                    ->requiredWith('password')
                                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                                    ->dehydrated(fn ($state) => filled($state)) // Ignore empty values on update
                                    ->same('password'),
                                Select::make('status')
                                    ->default('active')
                                    ->options([
                                        'active' => 'Active',
                                        'inactive' => 'Inactive',
                                    ]),
                                FileUpload::make('avatar')->disk('public')->directory('avatars'),
                            ]),
                    ]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Roles')
                            ->schema([
                                Forms\Components\Select::make('roles')
                                    ->relationship('roles', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),
                            ]),
                    ]),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('houses.code')->badge(),
                Tables\Columns\TextColumn::make('roles.name')->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultPaginationPageOption(5)
            ->filters([
                SelectFilter::make('house_id')
                    ->label('DD House')
//                    ->options(House::where('status','active')->pluck('code','id')),
                    ->options(function (){

                    }),

                SelectFilter::make('role')
                    ->options(function () {
                        // লগইন করা ইউজারের হাউজগুলো পাওয়া
                        $userHouses = auth()->user()->houses()->pluck('houses.id')->toArray();

                        // ইউজারের হাউজের সাথে সম্পর্কিত অন্যান্য ইউজারদের ভূমিকা পাওয়া
                        return Role::query()
                            ->whereHas('users', function ($query) use ($userHouses) {
                                $query->whereHas('houses', function ($q) use ($userHouses) {
                                    $q->whereIn('houses.id', $userHouses);
                                });
                            })
                            ->pluck('name')
                            ->mapWithKeys(function ($role) {
                                // ভূমিকার নাম টাইটেল কেসে ফরম্যাট করা
                                return [$role => Str::title($role)];
                            })
                            ->toArray();
                    })
                    ->query(function ($query, array $data) {
                        if (!empty($data['value'])) {
                            // লগইন করা ইউজারের হাউজগুলো
                            $userHouses = auth()->user()->houses()->pluck('houses.id')->toArray();

                            // নির্বাচিত ভূমিকা এবং হাউজের সাথে সম্পর্কিত ইউজার ফিল্টার করা
                            $query->whereHas('roles', function ($q) use ($data) {
                                $q->where('name', $data['value']);
                            })->whereHas('houses', function ($q) use ($userHouses) {
                                $q->whereIn('houses.id', $userHouses);
                            });
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            HousesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->latest('created_at');

        // Skip role-based filtering for view and edit routes
        if (request()->routeIs('filament.admin.resources.retailers.view') ||
            request()->routeIs('filament.admin.resources.retailers.edit')) {
            return $query;
        }

        // Apply role-based filtering
        if (Auth::user()->hasRole('super_admin')) {
            return $query;
        }

        return $query->where('status','active')->where('id', Auth::id());
    }
}
