<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Challenge;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActionRelationManager extends RelationManager
{
    protected static string $relationship = 'actions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'accepted' => 'Accepter',
                        'pending' => 'En Cours',
                        'refused' => 'Annuler',
                    ])
                    ->required(),
                    Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Utilisateur')
                    ->required(),
                Select::make('trash_id')
                    ->relationship('trash', 'name')
                    ->label('Déchet')
                    ->required(),
                Select::make('challenge_id')
                    ->label('Défi')
                    ->options(Challenge::pluck('name', 'id')->toArray())
                    ->searchable()
                    ->required(),
                // Forms\Components\BelongsToSelect::make('challenge_id')
                //     ->relationship('challenge', 'points')
                //     ->required(),
                Forms\Components\FileUpload::make('image_action')
                    ->image()
                    ->maxSize(1024),
                Forms\Components\FileUpload::make('image_throw')
                    ->image()
                    ->maxSize(1024),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('status')->label('Status')->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'accepted' => 'success',
                        'pending' => 'warning',
                        'refused' => 'danger',
                    }),
                // TextColumn::make('user.name')->label('User Name'),
                TextColumn::make('trash.name')->label('Déchet'),
                TextColumn::make('challenge.points')
                    ->label('Points')
                    ->badge()
                    ->getStateUsing(fn ($record) => $record->challenge->points * $record->quantity),
                    ImageColumn::make('image_action')
                    ->disk('public')
                    ->visibility('public')
                    ->height(100),
                ImageColumn::make('image_throw')
                    ->disk('public')
                    ->visibility('public')
                    ->height(100),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
