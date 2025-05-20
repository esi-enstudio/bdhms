<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\House;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HousesRelationManager extends RelationManager
{
    protected static string $relationship = 'houses';
    protected static ?string $title = 'Attach houses to the user';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                Tables\Columns\TextColumn::make('cluster'),
                Tables\Columns\TextColumn::make('region'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('code'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->form([
                        Forms\Components\Select::make('recordId')
                            ->label('Select House')
                            ->options(
                                House::where('status','active')->get()
                                    ->mapWithKeys(fn ($house) => [
                                        $house->id => "{$house->code} - {$house->name}"
                                    ])
                            )
                            ->preload()
                            ->searchable()
                            ->required(),
                    ])
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
