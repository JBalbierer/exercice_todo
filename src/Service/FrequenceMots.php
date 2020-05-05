<?php 

namespace App\Service;

class FrequenceMots
{
    //Stocke l'ensemble des titres des todos dans une seule variable de type string
    public function getAllTodosInOneString($todos)
    {
        $string = "";
        foreach($todos as $todo)
        {
            $titre = $todo->getTodoTitre();
            $string = $string.strtolower($titre)." ";
        }
        return substr($string, 0, -1);
    }

    //Sépare chaque mot (contenu dans une variable de type string) dans une variable de type array
    public function getAllWordsInAnArray($todos)
    {
        $todos = preg_split("/[\s,]+/", $todos);
        return $todos;
    }

    //Retourne un tableau contenant le nombre de fois qu'un mot apparait dans le tableau $todos
    //Exemple : $words['mise'] = 4
    public function getWordsCount($todos)
    {
        $words = array();
        foreach ($todos as $word)
        {
            $words[$word] = isset($words[$word]) === false ? 1 : $words[$word] + 1;
        }
        return $words;
    }

    //Retourne le mot apparaissant le plus de fois
    public function getWordMax($words)
    {
        $wordMax = array_search(max($words), $words);
        return $wordMax;
    }
}