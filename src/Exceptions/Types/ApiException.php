<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Exceptions\Types;

interface ApiException
{

    public function getMessage(): string;

    public function getCode(): int;

    public function getTypes(): array;
}
