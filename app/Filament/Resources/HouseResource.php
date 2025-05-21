<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HouseResource\Pages;
use App\Filament\Resources\HouseResource\RelationManagers;
use App\Models\House;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class HouseResource extends Resource
{
    protected static ?string $model = House::class;

    protected static ?string $navigationIcon = 'heroicon-s-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('cluster'),
                TextInput::make('region'),
                TextInput::make('district'),
                TextInput::make('thana'),
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('address'),
                TextInput::make('proprietor_name'),
                TextInput::make('contact_number'),
                TextInput::make('poc_name'),
                TextInput::make('poc_number'),
                DatePicker::make('lifting_date')->required()->native(false),
                Select::make('status')
                    ->required()
                    ->default('active')
                    ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ]),
                TextInput::make('remarks'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(['name','code'])
                    ->description(fn($record): string => $record->code ?? ''),
                TextColumn::make('region')
                    ->searchable(['region','cluster'])
                    ->description(fn($record): string => $record->cluster ?? ''),
                TextColumn::make('thana')
                    ->description(fn($record): string => $record->district ?? '')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email'),
                TextColumn::make('address')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('proprietor_name')
                    ->description(fn($record): string => $record->contact_number ?? '')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('poc_name')
                    ->description(fn($record): string => $record->poc_number ?? '')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('lifting_date')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match($state){
                        'active' => 'success',
                        'inactive' => 'danger'
                    })
                    ->formatStateUsing(fn (string $state): string => Str::title($state)),
                TextColumn::make('remarks')
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
            'index' => Pages\ListHouses::route('/'),
            'create' => Pages\CreateHouse::route('/create'),
            'edit' => Pages\EditHouse::route('/{record}/edit'),
        ];
    }
}
