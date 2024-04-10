<?php

namespace App\Filament\Resources;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Filament\Resources\ChannelResource\Pages;
use App\Filament\Resources\ChannelResource\RelationManagers;
use App\Models\Channel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components;

class ChannelResource extends Resource
{
    protected static ?string $model = Channel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {$doctors = Doctor::pluck('name')->toArray();
        $hospital = Hospital::pluck('name')->toArray();

        return $form
            ->schema([
                 
            Components\Select::make('doctor_name')
                ->label('Doctor')
                ->placeholder('Select Doctor')
                ->options($doctors)
                ->required(),
                Components\Select::make('hospital_name')
                ->label('Hospital')
                ->placeholder('Select Hospital')
                ->options($hospital)
                ->required(),
                Components\DatePicker::make('channel_date')
                ->label('Channel Date')
                ->format('d/m/Y')
                ->required(),
                Components\TimePicker::make('Start_time')
                ->label('Start Time')
                ->required(),
                Components\TimePicker::make('End_time')
                ->label('End Time')
                ->required(),
                
                Components\TextInput::make('channel_fee')
                ->label('Channel Fee ')
                ->rules('numeric')
                ->required(),
         
                Components\TextInput::make('maximum_patients_perday')
                ->label('maximum_patients_perday')
                ->rules('numeric')
                ->required(),
        



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListChannels::route('/'),
            'create' => Pages\CreateChannel::route('/create'),
            'edit' => Pages\EditChannel::route('/{record}/edit'),
        ];
    }
}
