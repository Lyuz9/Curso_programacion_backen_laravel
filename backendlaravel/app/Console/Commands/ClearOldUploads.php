<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearOldUploads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-old-uploads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eliminar archivos viejos por mantenimiento';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folderPath = public_path('tempfiles');

        if(!File::exists($folderPath)){
            $this->error('La carpeta de archivos temporales no existe.');
            return Command::FAILURE;
        }

        $files = File::files($folderPath);

        foreach($files as $file){
            File::delete($file);
            $this->info('Archivos eliminados: '.$file->getFilename());
        }

        $this->info('Limpieza de archivos completada.');
    }
}
