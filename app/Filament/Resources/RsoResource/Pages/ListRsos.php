<?php

namespace App\Filament\Resources\RsoResource\Pages;

use App\Filament\Resources\RsoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;

class ListRsos extends ListRecords
{
    protected static string $resource = RsoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->fields([
                    ImportField::make('project')
                        ->label('Project')
                        ->helperText('Define as project helper'),
                    ImportField::make('manager')
                        ->label('Manager'),
                ])
        ];
    }
}
