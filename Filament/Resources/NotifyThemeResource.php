<?php

namespace Modules\Notify\Filament\Resources;

use Modules\Notify\Filament\Resources\NotifyThemeResource\Pages;
use Modules\Notify\Filament\Resources\NotifyThemeResource\RelationManagers;
use Modules\Notify\Models\NotifyTheme;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Savannabits\FilamentModules\Concerns\ContextualResource;

class NotifyThemeResource extends Resource
{
    use ContextualResource;

    protected static ?string $model = NotifyTheme::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('lang')->options(self::fieldOptions('lang')),
                Forms\Components\Select::make('type')->options(self::fieldOptions('type')),
                Forms\Components\Select::make('post_type')->options(self::fieldOptions('post_type')),
                Forms\Components\TextInput::make('post_id'),
                Forms\Components\TextInput::make('subject'),
                Forms\Components\TextInput::make('from'),
                Forms\Components\TextInput::make('from_email'),
                Forms\Components\TextInput::make('logo_src'),
                Forms\Components\TextInput::make('logo_width'),
                Forms\Components\TextInput::make('logo_height'),
                // Forms\Components\TextInput::make('theme'),
                Forms\Components\Select::make('theme')->options(
                    [
                        'empty' => 'empty',
                        'ark' => 'ark',
                        'minty' => 'minty',
                        'sunny' => 'sunny',
                        'widgets' => 'widgets',
                    ]
                )
                ->default('empty'),
                Forms\Components\RichEditor::make('body')->columnSpanFull(),
                Forms\Components\RichEditor::make('body_html')->columnSpanFull(),
            ]);
    }

    public static function fieldOptions(string $field): array{
        $options=NotifyTheme::select($field)
            ->where($field,'!=',null)
            ->distinct()
                ->pluck($field, $field)
                ->toArray();
        return $options;
    }

    public static function table(Table $table): Table
    {
        
        
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('lang')->sortable(),
                Tables\Columns\TextColumn::make('type')->sortable(),
                Tables\Columns\TextColumn::make('post_id')->sortable(),
                Tables\Columns\TextColumn::make('post_type')->sortable(),
                Tables\Columns\TextColumn::make('logo_src')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('lang')
                    ->options(self::fieldOptions('lang')),
                Tables\Filters\SelectFilter::make('post_type')
                    ->options(self::fieldOptions('post_type')),
                Tables\Filters\SelectFilter::make('type')
                    ->options(self::fieldOptions('type')),
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //RelationManagers\LinkableRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotifyThemes::route('/'),
            'create' => Pages\CreateNotifyTheme::route('/create'),
            'edit' => Pages\EditNotifyTheme::route('/{record}/edit'),
        ];
    }    
}
