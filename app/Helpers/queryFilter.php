<?php

function queryFilter($model, $condition)
{
    $result = $model->when(isset($condition['whereCondition']), function ($q) use ($condition) {
        foreach ($condition['whereCondition'] as $item) {
            if (strtotime($item['value'])) {
                $q->whereDate($item['columnName'], $item['value']);
            } else {
                $q->where($item['columnName'], $item['value']);
            }
        }
    })->when(isset($condition['searchKeyword']), function ($q) use ($condition) {
        foreach ($condition['searchKeyword'] as $item) {
            $q->where($item['columnName'], 'like', '%' . $item['value'] . '%');
        }
    })->when(isset($condition['operatorCondition']), function ($q) use ($condition) {
        foreach ($condition['operatorCondition'] as $item) {
            if (strtotime($item['value'])) {
                $q->whereDate($item['columnName'], $item['operator'], $item['value']);
            } else {
                $q->where($item['columnName'], $item['operator'], $item['value']);
            }
        }
    })->when(isset($condition['betweenCondition']), function ($q) use ($condition) {
        foreach ($condition['betweenCondition'] as $item) {
            $q->whereBetween($item['columnName'], $item['value']);
        }
    })->when(isset($condition['whereRawCondition']), function ($q) use ($condition) {
        foreach ($condition['whereRawCondition'] as $item) {
            $q->whereRaw($item);
        }
    })->when(isset($condition['sortRawCondition']), function ($q) use ($condition) {
        foreach ($condition['sortRawCondition'] as $item) {
            $q->orderByRaw($item);
        }
    })->when(isset($condition['sortCondition']), function ($q) use ($condition) {
        foreach ($condition['sortCondition'] as $item) {
            $q->orderBy($item['columnName'], $item['value']);
        }
    });
    return $result;
}
