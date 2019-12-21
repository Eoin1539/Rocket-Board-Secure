<?php

namespace MFlor\Pwned\Models;

class Password
{
    /** @var string|null */
    private $hash;
    /** @var int */
    private $occurences;

    public function __construct()
    {
        $this->hash = null;
        $this->occurences = 0;
    }

    /**
     * @return string|null
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return Password
     */
    public function setHash(string $hash): Password
    {
        $this->hash = strtolower($hash);
        return $this;
    }

    /**
     * @return int
     */
    public function getOccurences(): int
    {
        return $this->occurences;
    }

    /**
     * @param int $occurences
     * @return Password
     */
    public function setOccurences(int $occurences): Password
    {
        $this->occurences = $occurences;
        return $this;
    }

    /**
     * Format: `00969D6155DDF8FDEA98D8E0F85ADE21568:2`
     *
     * @param string $string
     * @param string|null $prefix
     * @return Password
     */
    public function fromString(string $string, string $prefix = null)
    {
        if ($prefix) {
            $string = $prefix . $string;
        }
        if (($parts = explode(':', $string)) && !empty($parts) && count($parts) === 2) {
            $this->setHash($parts[0]);
            $this->setOccurences(intval($parts[1]));
        }

        return $this;
    }
}
