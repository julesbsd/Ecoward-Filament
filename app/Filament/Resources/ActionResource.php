<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActionResource\Pages;
use App\Filament\Resources\ActionResource\RelationManagers;
use App\Filament\Resources\ActionResource\Widgets\ActionOverview;
use App\Models\Action;
use App\Models\Challenge;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Components\Tab;

class ActionResource extends Resource
{
    protected static ?string $model = Action::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected function getHeaderWidgets(): array
    {
        return [
           ActionOverview::class,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status')
                    ->options([
                        'accepted' => 'Accepter',
                        'pending' => 'En Cours',
                        'refused' => 'Annuler',
                    ])
                    ->required(),
                Select::make('user_id')
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
                FileUpload::make('image_action')
                    ->image()
                    ->maxSize(1024),
                FileUpload::make('image_throw')
                    ->image()
                    ->maxSize(1024),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('status'),
                TextColumn::make('user.name')->label('Utilisateur'),
                TextColumn::make('trash.name')->label('Déchet'),
                TextColumn::make('quantity')->label('Quantité'),
                TextColumn::make('challenge.points')
                    ->label('Points')
                    ->badge()
                    ->getStateUsing(fn ($record) => $record->challenge->points * $record->quantity),
                TextColumn::make('status')->label('Status')->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'accepted' => 'success',
                        'pending' => 'warning',
                        'refused' => 'danger',
                    }),
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
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'En Cours',
                        'accepted' => 'Accepté',
                        'refused' => 'Annulé',
                    ])
                    ->label('Status'),
                    Tables\Filters\SelectFilter::make('user_id')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->label('Utilisateur'),
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

    public static function getWidgets(): array
    {
        return [
            ActionOverview::class
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderByRaw("FIELD(status, 'pending') DESC")
            ->orderBy('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActions::route('/'),
            // 'create' => Pages\CreateAction::route('/create'),
            'edit' => Pages\EditAction::route('/{record}/edit'),
        ];
    }
}
