<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityScheduleResource\Pages;
use App\Filament\Resources\ActivityScheduleResource\RelationManagers;
use App\Models\ActivitySchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\form;

class ActivityScheduleResource extends Resource
{
    protected static ?string $model = ActivitySchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('activity_date')
                ->label('Activity Date')
                ->required(),
            Forms\Components\TimePicker::make('activity_time')
                ->label('Activity Time')
                ->required(),
            Forms\Components\TextInput::make('No_OP')
                ->label('Order Number'),
            Forms\Components\Select::make('order')
                ->label('Order Type')
                ->options([
                    'kerjasama' => 'Kerjasama',
                    'walkin' => 'Walk-in',
                    'online' => 'Online',
                    'reserve' => 'Reserve',
                ])
                ->required(),
            Forms\Components\TextInput::make('customer_name')
                ->label('Customer Name')
                ->required(),
            Forms\Components\TextInput::make('customer_phone')
                ->label('Customer Phone')
                ->tel()
                ->required(),
            Forms\Components\Select::make('category_id')
                ->label('Category')
                ->relationship('category', 'name') // Asumsikan ada relasi dengan model Category
                ->required(),
            Forms\Components\Select::make('subcategory_id')
                ->label('Subcategory')
                ->relationship('subcategory', 'name') // Asumsikan ada relasi dengan model Subcategory
                ->required(),
            Forms\Components\Select::make('products_id')
                ->label('Products')
                ->relationship('products', 'name') // Asumsikan ada relasi dengan model Product
                ->required(),
            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Pending',
                    'done' => 'Done',
                    'cancel' => 'Cancel',
                    'confirmed' => 'Confirmed',
                ])
                ->default('pending')
                ->required(),
            Forms\Components\Select::make('users_id')
                ->relationship('users', 'name')
                ->required(),
        ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('activity_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('activity_time')->time()->sortable(),
                Tables\Columns\TextColumn::make('No_OP')->label('Order Number')->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('order')->label('Order Type')->sortable(),
                Tables\Columns\TextColumn::make('customer_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('customer_phone')->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('Category')->sortable(),
                Tables\Columns\TextColumn::make('subcategory.name')->label('Subcategory')->sortable(),
                Tables\Columns\TextColumn::make('Products.name')->label('Products')->sortable(),
                Tables\Columns\TextColumn::make('users.name')->label('User')->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'primary' => fn ($state): bool => $state === 'pending',
                    'success' => fn ($state): bool => $state === 'done',
                    'danger' => fn ($state): bool => $state === 'cancel',
                    'warning' => fn ($state): bool => $state === 'confirmed',
                ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListActivitySchedules::route('/'),
            'create' => Pages\CreateActivitySchedule::route('/create'),
            'edit' => Pages\EditActivitySchedule::route('/{record}/edit'),
        ];
    }
}
