<?php

declare(strict_types=1);
/**
 * @see https://github.com/Snowfire/Beautymail/blob/master/src/Snowfire/Beautymail/Beautymail.php
 */

namespace Modules\Notify\Emails;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Mail\PendingMail;
use Modules\Notify\Datas\BeautyEmailData;
use Modules\UI\Services\ThemeService;

class BeautyEmail implements Mailer {
    /**
     * Contains settings for emails processed by Beautymail.
     */
    private array $settings = [];

    /**
     * The mailer contract depended upon.
     */
    private Mailer $mailer;

    /**
     * Initialise the settings and mailer.
     */
    public function __construct(array $settings = []) {
        $beauty = BeautyEmailData::from(config('beautymail'));

        // $default['css'] = ! is_null(config('beautymail.css')) && count(config('beautymail.css')) > 0 ? implode(' ', config('beautymail.css')) : '';

        $beauty->view['css'] = implode(' ', $beauty->css);

        $settings = array_merge($beauty->view, $settings);
        $this->settings = $settings;
        $mailer = app()->make('Illuminate\Contracts\Mail\Mailer');
        if (! $mailer instanceof Mailer) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }
        $this->mailer = $mailer;
        $this->setLogoPath();
    }

    public function getSettings(): array {
        return $this->settings;
    }

    /**
     * @param mixed $users
     */
    public function to($users): PendingMail {
        return (new PendingMail($this))->to($users);
    }

    /**
     * @param mixed $users
     */
    public function bcc($users): PendingMail {
        return (new PendingMail($this))->bcc($users);
    }

    /**
     * @param mixed $users
     */
    public function cc($users): PendingMail {
        return (new PendingMail($this))->cc($users);
    }

    /**
     * Retrieve the settings.
     */
    public function getData(): array {
        return $this->settings;
    }

    /**
     * @return \Illuminate\Contracts\Mail\Mailer
     */
    public function getMailer() {
        return $this->mailer;
    }

    /**
     * Send a new message using a view.
     *
     * @param string|array    $view
     * @param \Closure|string $callback
     *
     * @return \Illuminate\Mail\SentMessage|null
     */
    public function send($view, array $data = [], $callback = null) {
        $data = array_merge($this->settings, $data);

        return $this->mailer->send($view, $data, $callback);
    }

    /**
     * Send a new message using the a view via queue.
     *
     * @param string|array    $view
     * @param \Closure|string $callback
     *
     * @return void
     */
    public function queue($view, array $data, $callback) {
        $data = array_merge($this->settings, $data);
        // 13    Method Illuminate\Mail\Mailer::queue() invoked with 3 parameters, 1-2 required.
        // 113    Parameter #2 $queue of method Illuminate\Mail\Mailer::queue() expects string|null, array given.
        // $this->mailer->queue($view, $data, $callback);
    }

    /**
     * Summary of view.
     */
    public function view(string $view, array $data = []): Renderable {
        $data = array_merge($this->settings, $data, ['view' => $view]);

        return view($view, $data);
    }

    /**
     * Send a new message when only a raw text part.
     *
     * @param string               $text
     * @param \Closure|string|null $callback
     *
     * @return \Illuminate\Mail\SentMessage|null
     */
    public function raw($text, $callback) {
        return $this->mailer->send(['raw' => $text], [], $callback);
    }

     /* Get the array of failed recipients.
     * Call to an undefined method Illuminate\Contracts\Mail\Mailer::failures()
     * @return array
     *
     */
    /*public function failures():array {
        return $this->mailer->failures();
    }*/

    /**
     * @return mixed
     */
    private function setLogoPath() {   /*
        $this->settings['logo']['path'] = str_replace(
            '%PUBLIC%',
            \Request::getSchemeAndHttpHost(),
            $this->settings['logo']['path']
        );*/
        $this->settings['logo']['path'] = url(ThemeService::asset($this->settings['logo']['path']));
    }
}
