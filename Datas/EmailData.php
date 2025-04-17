<?php

declare(strict_types=1);

namespace Modules\Notify\Datas;

use Spatie\LaravelData\Data;

class EmailData extends Data {
    public string $from;
    public string $from_email;
    public string $subject;
    public string $body_html;
    public string $body;
}
