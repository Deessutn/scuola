<?php
namespace Database\Seeders;

use App\Models\Instrument;
use Illuminate\Database\Seeder;

class InstrumentsTableSeeder extends Seeder
{
    public function run()
    {
        $instruments = [
    'Chitarra', 'Basso', 'Batteria', 'Voce', 'Tastiera', 'Pianoforte', 'Sassofono', 'Violino', 'Viola', 'Violoncello',
    'Contrabbasso', 'Flauto Traverso', 'Tromba', 'Trombone', 'Clarinetto', 'Oboe', 'Fagotto', 'Corno', 'Synthesizer',
    'Ukulele', 'Mandolino', 'Banjo', 'Arpa', 'Fisarmonica', 'Hammond Organ', 'Xilofono',

    'Drum Machine', 'Sampler', 'Loop Station', 'Controller MIDI', 'Keytar', 'Turntables', 'Theremin', 'EWI (Electronic Wind Instrument)',

    'Congas', 'Bongos', 'Djembe', 'Cajón', 'Tamburello', 'Maracas', 'Timpani', 'Triangolo', 'Campanacci', 'Glockenspiel',

    'Zampogna', 'Organetto diatonico', 'Mandola', 'Piffero', 'Ciaramella', 'Chitarra battente', 'Launeddas', 'Triccheballacche',

    'Clavicembalo', 'Liuto', 'Viola da gamba', 'Salterio', 'Lira', 'Arpa celtica', 'Cornamusa', 'Citara', 'Tiorba',

    'Sitar', 'Tabla', 'Erhu', 'Shamisen', 'Koto', 'Didgeridoo', 'Balafon', 'Ngoni', 'Sarangi', 'Kalimba',
    'Hang drum', 'Steelpan', 'Guqin', 'Bawu', 'Pipa', 'Duduk', 'Pan flute', 'Ocarina', 'Udu', 'Berimbau',

    'Kazoo', 'Melodica', 'Whistle', 'Kazakh dombra', 'Hardanger fiddle', 'Nyckelharpa', 'Glass harmonica'
];


        foreach ($instruments as $name) {
            Instrument::create(['name' => $name]);
        }
    }
}
