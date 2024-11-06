<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    private int $m_score1 = 0;

    private int $m_score2 = 0;



    public function wonPoint(string $playerName): void
    {
        if ($playerName === 'player1') {
            $this->m_score1++;
        } else {
            $this->m_score2++;
        }
    }

    public function getScore(): string
    {
        if ($this->m_score1 === $this->m_score2) {
            $score = $this->getScoreIfMatched($this->m_score1);
        } elseif ($this->m_score1 >= 4 || $this->m_score2 >= 4) {
            $score = $this->getScoreIfGamePoint();
        } else {
            $score = $this->getScoreForPlayer($this->m_score1) .'-'. $this->getScoreForPlayer($this->m_score2);
        }
        return $score;
    }

    /**
     * @return string
     */
    public function getScoreIfMatched(int $m_score1): string
    {
        return match ($m_score1) {
            0 => 'Love-All',
            1 => 'Fifteen-All',
            2 => 'Thirty-All',
            default => 'Deuce',
        };
    }

    /**
     * @return string
     */
    public function getScoreIfGamePoint(): string
    {
        $minusResult = $this->m_score1 - $this->m_score2;
        $score ='';
        if (abs($minusResult) === 1) {
            $score = 'Advantage player';
        } elseif (abs($minusResult) >= 2) {
            $score = 'Win for player';
        }
        if($minusResult < 0) {
            return $score.='2';
        }
        return $score.'1';
    }

    /**
     * @param int $tempScore
     * @param string $score
     * @return string
     */
    public function getScoreForPlayer(int $tempScore): string
    {
        $score='';
        switch ($tempScore) {
            case 0:
                $score = 'Love';
                break;
            case 1:
                $score = 'Fifteen';
                break;
            case 2:
                $score = 'Thirty';
                break;
            case 3:
                $score = 'Forty';
                break;
        }
        return $score;
    }
}
