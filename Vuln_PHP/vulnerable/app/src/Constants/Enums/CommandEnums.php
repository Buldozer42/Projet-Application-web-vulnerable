<?php

enum CommandEnums: string
{
    case ARTICLE_TOTAL = 'Total des ateliers';

    public static function toFormChoices(): array
    {
        return [
            self::ARTICLE_TOTAL->value => self::ARTICLE_TOTAL,
        ];
    }

    public function getShellCommand(): string
    {
        return match($this) {
            self::ARTICLE_TOTAL => 'php bin/console app:total',
        };
    }
}