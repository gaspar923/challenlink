<?php

function noIterate($strArr): string
{
    $smallestSubstring = '';

    $validation = validateParameter($strArr);
    if ($validation['status'] === 'error') return $validation['message'];

    $substringArr = getSubstringArr($strArr);
    if (count($substringArr) === 0) return 'There are no substrings.';

    $smallestSubstring = $substringArr[0];

    foreach ($substringArr as $substring) {
        if (strlen($substring) < strlen($smallestSubstring)) $smallestSubstring = $substring;
    }

    return $smallestSubstring;
}


function validateParameter($strArr): array
{
    try {
        if (!is_array($strArr)) throw new InvalidArgumentException('The value must be a array.');
        if (count($strArr) !== 2) throw new InvalidArgumentException('The value must have 2 elements.');
        if (
            !is_string($strArr[0]) ||
            !is_string($strArr[1])
        ) throw new InvalidArgumentException('The first and second element must be string.');
        if (
            (strlen($strArr[0]) === 0 || strlen($strArr[0]) > 50) ||
            (strlen($strArr[1]) === 0 || strlen($strArr[1]) > 50)
        ) throw new InvalidArgumentException('The first and second element must have between 1-50 characters.');
        if (
            !preg_match('/^[a-z]+$/', $strArr[0]) ||
            !preg_match('/^[a-z]+$/', $strArr[1])
        ) throw new InvalidArgumentException('The first and second element only must contain lowercase alphabetic characters.');
    } catch (InvalidArgumentException $th) {
        return [
            'status' => 'error',
            'message' => $th->getMessage()
        ];
    }

    return [
        'status' => 'ok',
        'message' => ''
    ];
}

function getSubstringArr($strArr): array
{
    if (strlen($strArr[0]) >= strlen($strArr[1])) {
        $bigStr = $strArr[0];
        $smallStr = $strArr[1];
    } else {
        $bigStr = $strArr[1];
        $smallStr = $strArr[0];
    }

    $bigArr = str_split($bigStr);
    $smallArr = str_split($smallStr);

    $substringArr = [];
    foreach ($bigArr as $mainKey => $character) {
        if (count($bigArr) - ($mainKey) < count($smallArr)) break;
        if (!in_array($character, $smallArr)) continue;

        $substring = '';
        $auxSmallArr = $smallArr;

        for ($i = $mainKey; $i < count($bigArr); $i++) {
            $substring .= $bigArr[$i];

            $arrayKey = array_search($bigArr[$i], $auxSmallArr);
            if ($arrayKey !== false) {
                unset($auxSmallArr[$arrayKey]);
                $auxSmallArr = array_values($auxSmallArr);
            }

            if (count($auxSmallArr) === 0) {
                array_push($substringArr, $substring);
                break;
            }
        }
    }

    return $substringArr;
}

// keep this function call here
echo noIterate(["ahffaksfajeeubsne", "jefaa"]);
