<?php
/**
 * TokenStorage class
 * User: marhone
 * Date: 2019/1/8
 * Time: 14:51
 */

namespace App\Privileges;


class TokenStorage
{
    private $tokens = [];

    /**
     * @return array
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * @return mixed|null
     */
    public function getLastToken()
    {
        $lastIndex = count($this->tokens) - 1;

        if (isset($this->tokens[$lastIndex])) {
            return $this->tokens[$lastIndex];
        }

        return null;
    }

    /**
     * @param $token
     */
    public function addToken($token)
    {
        $this->tokens[] = $token;
    }
}