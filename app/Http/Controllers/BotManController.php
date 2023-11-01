<?php

namespace App\Http\Controllers;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use ConversationController;
use Illuminate\Http\Request;
use OnboardingConversation;

class BotManController extends Controller
{
    public $botman;

    public function __construct()
    {
        $this->botman = app('botman');
    }
    public function handle()
    {

        $this->botman->hears('{message}', function ($bot, $message) {
            if ($message == 'mulai') {
                $pil = [
                    'Bagaimana Sistem Informasi Pertanian di Desa Kalinganyar membantu petani dalam mengelola tanaman mereka?',
                    'Apa saja data yang dikumpulkan oleh Sistem Informasi Pertanian Desa Kalinganyar?',
                    'Bagaimana proses pengumpulan data pertanian di Desa Kalinganyar dilakukan?',
                    'Bagaimana petani di Desa Kalinganyar mengakses informasi dan saran pertanian melalui sistem ini?',
                    'Apakah ada program pelatihan atau bimbingan untuk membantu petani menggunakan Sistem Informasi Pertanian ini ?',
                    'Apakah terdapat rencana untuk mengembangkan atau meningkatkan Sistem Informasi Pertanian di masa mendatang?',
                ];

                $question = $this->QuestionButton('Silahkan pilih pertanyaan yang anda ingin ketahui ?', $pil);
                // $bot->reply('Hello nama saya Sam');

                $bot->ask($question, function ($answer, $conversation) use ($pil) {
                    $selectedColor = $answer->getValue();
                    if ($selectedColor == 1) {
                        $conversation->say($pil[0]);
                        $conversation->say('Sistem Informasi Pertanian dapat membantu pengelolaan dari segi bidang bahan atau perawatan yang dibutuhkan petani.');
                    } elseif ($selectedColor == 2) {
                        $conversation->say($pil[1]);
                        $conversation->say('Data yang dikumpulkan yaitu data tanaman seperti tanaman yang bisa ditanaman pada lokasi desa kalinganya dan data petani seperti berapa banyak petani di desa kalinganyar.');
                    } elseif ($selectedColor == 3) {
                        $conversation->say($pil[2]);
                        $conversation->say('Data dikumpulkan dengan cara melakukan survei dan wawancara terhadap para petani di desa kalinganyar.');
                    } elseif ($selectedColor == 4) {
                        $conversation->say($pil[3]);
                        $conversation->say('Para petani desa kalinganyar dapat mengakses informasi melalui website ini hanya dengan cara membuka website ini atau untuk mengakses lebih dalam petani dapat mendaftarkan diri pada menu register,lalu login pada website.');
                    } elseif ($selectedColor == 5) {
                        $conversation->say($pil[6]);
                        $conversation->say('Dalam sistem ini masih belum ada program pelatihan atau bimbingan untuk membantu petani.');
                    } elseif ($selectedColor == 6) {
                        $conversation->say($pil[5]);
                        $conversation->say('Tentu , pengembangan dan peningkatan sistem akan dilakukan secara bertahap di masa mendatang.');
                    } else {
                        $conversation->say('Mohon maaf saya belum bisa menjawab pertanyaan tersebut');
                    }
                });
            } else {
                $bot->reply('Silahkan ketik mulai terlebih dahulu');
            }
        });

        $this->botman->listen();
    }

    public function QuestionButton($pertanyaan, $arr)
    {
        $button = [];
        foreach ($arr as $index => $value) {
            $new_button = Button::create($value)->value($index + 1);
            array_push($button, $new_button);
        }
        $question = Question::create($pertanyaan)
            ->addButtons($button);

        return $question;
    }
}
