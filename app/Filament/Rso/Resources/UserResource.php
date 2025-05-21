<?php

namespace App\Filament\Rso\Resources;

use App\Filament\Rso\Resources\UserResource\Pages;
use App\Filament\Rso\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Group::make()
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
                                    ->visible(fn () => Auth::user()?->hasRole('super_admin'))
                                    ->options([
                                        'active' => 'Active',
                                        'inactive' => 'Inactive',
                                    ]),
                                FileUpload::make('avatar')->disk('public')->directory('avatars'),
                            ]),
                    ]),
            ]);
    }

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
                //
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
            //
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

        // Everyone else can only see themselves
        return $query->where('id', Auth::id());
    }
}
