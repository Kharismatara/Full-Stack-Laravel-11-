<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeSpaceResource\Pages;
use App\Filament\Resources\OfficeSpaceResource\RelationManagers;
use App\Models\OfficeSpace;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficeSpaceResource extends Resource
{
    protected static ?string $model = OfficeSpace::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                -> required()
                ->maxLength(255),
                
                Forms\Components\TextInput::make('slug')
                ->label('Slug')
                ->unique(OfficeSpace::class, 'slug', ignoreRecord: true) // Validasi unik
                ->default(fn (callable $get) => \Illuminate\Support\Str::slug($get('name'))) // Generate slug otomatis
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('address')
                -> required()
                ->maxLength(255),

                Forms\Components\FileUpload::make('thumbnail')
                -> image()
                ->required(),

                Forms\Components\Textarea::make('about')
                -> required()
                ->maxLength(255),

                Forms\Components\Repeater::make('photo')
                -> relationship('photo')
                ->schema([
                    Forms\Components\FileUpload::make('photo')
                    -> image()
                    ->required(),
                ]),

                Forms\Components\Repeater::make('benefits')
                -> relationship('benefits')
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->required(),
                ]),
               
                Forms\Components\Select::make('city_id')
                ->relationship('city','name')
                ->searchable()
                ->required(),


                Forms\Components\TextInput::make('price')
                ->required()
                ->numeric()
                ->prefix('IDR'),

                Forms\Components\TextInput::make('duration')
                ->required()
                ->numeric()
                ->prefix('Days'),

                Forms\Components\Select::make('is_open')
                ->options(
                    [
                        true => 'Open',
                        false => 'Not Open '
                    ])

                ->required(),
                    
                    Forms\Components\Select::make('is_ful_booked')
                    ->options(
                        [
                            true => 'Not Available ',
                            false => 'Available '
                        ])
                        ->required()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                    Tables\Columns\TextColumn::make('thumbnail'),
                    

                    Tables\Columns\TextColumn::make('city.name'),

                    Tables\Columns\IconColumn::make('is_ful_booked')
                    ->boolean()
                    ->trueColor('danger')
                    ->falseColor('success')
                    ->trueIcon('heroicon-o-x-circle') // Ikon untuk kondisi true
                    ->falseIcon('heroicon-o-check-circle') // Ikon untuk kondisi false
                    ->label('Availabel') // Label kolom

            ])
            ->filters([
              

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
            'index' => Pages\ListOfficeSpaces::route('/'),
            'create' => Pages\CreateOfficeSpace::route('/create'),
            'edit' => Pages\EditOfficeSpace::route('/{record}/edit'),
        ];
    }
}