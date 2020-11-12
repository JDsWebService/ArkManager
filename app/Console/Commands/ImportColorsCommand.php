<?php

namespace App\Console\Commands;

use App\Models\Ark\Color;
use App\Handlers\LogHandler;
use App\Handlers\ColorHandler;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Exception\ParseException;

class ImportColorsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:colors {--F|fresh : Whether the job should refresh the database table before running}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports colors from the colors.yaml file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fresh = $this->option('fresh');
        if($fresh) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Color::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        $this->info('Starting the importation of colors from YAML file.');

        $this->info('Opening YAML file.');
        $file = Storage::get('/public/Base/colors.yaml');

        $this->info('Trying to parse YAML file.');
        try {
            $colors = Yaml::parse($file);
            $this->info('YAML file parsed.');
        } catch (ParseException $exception) {
            dd('Unable to parse the YAML string: %s', $exception->getMessage());
        }

        $this->info('Counting entries in YAML file.');
        $colorsCount = count($colors);
        $bar = $this->output->createProgressBar($colorsCount);
        $bar->start();

        $this->info('Adding colors to the database');
        foreach($colors as $colorID => $values) {
            $this->info('Adding color: ' . $values['name'] . ' with the ID of: ' . $colorID);

            // Create new color model instance
            $color = new Color;
            // Assign meta data
            $color->colorID = $colorID;
            $color->name = $values['name'];
            $color->iniString = ColorHandler::getINISearchString($values['string']);

            // Process the Unreal Color String & Assign to Color Model Instance
            $unrealRGBA = ColorHandler::parseUnrealString($values['string']);
            $color->uRed = $unrealRGBA['R'];
            $color->uGreen = $unrealRGBA['G'];
            $color->uBlue = $unrealRGBA['B'];
            $color->uAlpha = $unrealRGBA['A'];
            $this->info("Unreal Color Values:");
            $this->info("Red: {$unrealRGBA['R']}");
            $this->info("Green: {$unrealRGBA['G']}");
            $this->info("Blue: {$unrealRGBA['B']}");

            // Get computed RGBA Values
            $computedRGBA = ColorHandler::getRGBAFromUnreal($unrealRGBA);
            $color->cRed = $computedRGBA['R'];
            $color->cGreen = $computedRGBA['G'];
            $color->cBlue = $computedRGBA['B'];
            $color->rgb = "rgb({$computedRGBA['R']}, {$computedRGBA['G']}, {$computedRGBA['B']})";
            $this->info("Computed RGB Color Values:");
            $this->info("Red: {$computedRGBA['R']}");
            $this->info("Green: {$computedRGBA['G']}");
            $this->info("Blue: {$computedRGBA['B']}");

            // Get Hex Values from Computed RGBA Array
            $computedHex = strtoupper(ColorHandler::getHexFromRGBA($computedRGBA));
            $this->info("Computed Hex Value is: {$computedHex}");

            $this->info('Checking if computed hex value matches hex from YAML file.');
            // Check if the YAML files hex and the computed hex values match
            if($values['hex'] == $computedHex) {
                $this->info('Computed Hex & Hex From YAML File Match');
                $color->hex = $computedHex;
            } else {
                $this->error('Computed hex does not match hex in YAML file');
                return;
            }

            $color->save();
            $bar->advance();
        }

        $this->info('');
        $this->info("Imported {$colorsCount} colors to the database successfully.\n");
        LogHandler::event('cli', 'ImportColorsCommand', 'import:colors command was run successfully');
        $bar->finish();
    }
}
