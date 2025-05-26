<?php

function findPoint($strArr): string
{
    $duplicatedElementStr = '';

    $validation = validateParameter($strArr);
    if ($validation['status'] === 'error') return $validation['message'];

    $duplicatedElementArr = getDuplicatedElementArr($strArr);
    if (count($duplicatedElementArr) === 0) return 'false';

    $duplicatedElementStr = implode(",", $duplicatedElementArr);

    return $duplicatedElementStr;
}

function validateParameter($strArr): array
{
    try {
        if (!is_array($strArr)) throw new InvalidArgumentException('The value must be a array.');
        if (count($strArr) !== 2) throw new InvalidArgumentException('The value must have 2 elements.');
        if (!is_string($strArr[0]) || !is_string($strArr[1])) throw new InvalidArgumentException('The first and second element must be string.');
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

function getDuplicatedElementArr($strArr): array
{
    $duplicatedElementArr = [];
    $firstArr = explode(",", $strArr[0]);
    $secondArr = explode(",", $strArr[1]);

    $duplicatedElementArr = [];
    foreach ($firstArr as  $firstArrValue) {
        foreach ($secondArr as  $secondArrValue) {
            if ($firstArrValue === $secondArrValue) array_push($duplicatedElementArr, $firstArrValue);
        }
    }

    return $duplicatedElementArr;
}

// keep this function call here
echo findPoint(['1, 3, 4, 7, 13', '1, 2, 4, 13, 15']);
