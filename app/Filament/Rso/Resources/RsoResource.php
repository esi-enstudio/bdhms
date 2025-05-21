<?php

namespace App\Filament\Rso\Resources;

use App\Filament\Rso\Resources\RsoResource\Pages;
use App\Filament\Rso\Resources\RsoResource\RelationManagers;
use App\Models\House;
use App\Models\Rso;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RsoResource extends Resource
{
    protected static ?string $model = Rso::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('house_id')
                    ->label('House')
                    ->options(fn () => House::where('status', 'active')->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit'))
                    ->afterStateUpdated(function (Set $set){
                        $set('user_id', null);
                        $set('supervisor_id', null);
                    }),

                Select::make('user_id')
                    ->label('User')
                    ->options(function (Get $get) {
                        $houseId = $get('house_id');
                        $userId = $get('user_id');

                        // fallback array
                        $users = collect();

                        // যদি house_id থাকে (create page বা reactive update এর সময়)
                        if ($houseId) {
                            $users = User::query()
                                ->whereHas('houses', fn ($q) => $q->where('houses.id', $houseId))
                                ->whereHas('roles', fn ($q) => $q->where('roles.name', 'rso'))
                                ->where('status', 'active')
                                ->whereNotIn('id', Rso::whereNotNull('user_id')->pluck('user_id'))
                                ->pluck('name', 'id');
                        }

                        // যদি edit page হয় এবং user_id সিলেক্ট করা থাকে, তাহলে তার নাম দেখাও
                        if ($userId && !$users->has($userId)) {
                            $user = User::find($userId);
                            if ($user) {
                                $users->put($user->id, $user->name);
                            }
                        }

                        return $users->toArray();
                    })
                    ->required()
                    ->preload()
                    ->searchable()
                    ->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),



                Select::make('supervisor_id')
                    ->label('Supervisor')
                    ->options(function (Get $get) {
                        $houseId = $get('house_id');

                        if (!$houseId) return [];

                        return User::query()
                            ->whereHas('houses', fn ($q) => $q->where('houses.id', $houseId))
                            ->whereHas('roles', fn ($q) => $q->where('roles.name', 'supervisor'))
                            ->where('status', 'active')
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->required()

                    ->preload()
                    ->searchable()
                    ->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),

                TextInput::make('osrm_code')
                    ->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('employee_code')
                    ->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('rso_code')
                    ->required()
                    ->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('itop_number')
                    ->numeric()
                    ->required()
                    ->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('pool_number')
                    ->numeric()
                    ->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('personal_number')->numeric(),
                TextInput::make('name_as_bank_account')
                    ->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('religion'),
                TextInput::make('bank_name'),
                TextInput::make('bank_account_number')->numeric(),
                TextInput::make('brunch_name'),
                TextInput::make('routing_number')->numeric(),
                TextInput::make('education'),
                Select::make('blood_group')
                    ->options([
                        'A+'  => 'A+',
                        'A-'  => 'A-',
                        'B+'  => 'B+',
                        'B-'  => 'B-',
                        'AB+' => 'AB+',
                        'AB-' => 'AB-',
                        'O+'  => 'O+',
                        'O-'  => 'O-',
                    ])
                    ->searchable()
                ,
                Select::make('gender')
                    ->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit'))
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->default('male')
                    ->required(),
                TextInput::make('present_address')->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('permanent_address')->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('father_name')->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('mother_name')->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('market_type')->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('salary')->numeric()->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('category')->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('agency_name')->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                DatePicker::make('dob')->native(false)->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('nid')->numeric()->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('division')->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('district')->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('thana')->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                TextInput::make('sr_no')->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                DatePicker::make('joining_date')->native(false)->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                DatePicker::make('resign_date')->native(false)->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
                Select::make('status')
                    ->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit'))
                    ->default('active')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
                TextInput::make('remarks'),
                TextInput::make('document')->disabled(fn () => request()->routeIs('filament.rso.resources.rsos.edit')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('house.code')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('supervisor.name'),
                TextColumn::make('user.name')->label('Name'),
                TextColumn::make('osrm_code')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('employee_code')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('rso_code')
                    ->searchable(),
                TextColumn::make('itop_number')
                    ->searchable(),
                TextColumn::make('pool_number')
                    ->searchable(),
                TextColumn::make('personal_number')
                    ->searchable(),
                TextColumn::make('name_as_bank_account')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('religion')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('bank_name')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('bank_account_number')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('brunch_name')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('routing_number')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('education')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('blood_group')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('gender')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('present_address')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('permanent_address')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('father_name')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('mother_name')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('market_type')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('salary')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('category')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('agency_name')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('dob')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nid')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('division')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('district')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('thana')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sr_no')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('joining_date')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('resign_date')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge()
                    ->color(function ($state){
                        if ($state == "active") {
                            return 'success';
                        }elseif ($state == "inactive") {
                            return 'danger';
                        }

                        return false;
                    })
                    ->formatStateUsing(fn(string $state): string => Str::title($state)),
                TextColumn::make('remarks')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('document')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
            'index' => Pages\ListRsos::route('/'),
            'create' => Pages\CreateRso::route('/create'),
            'edit' => Pages\EditRso::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', Auth::id())
            ->latest('created_at');
    }
}
