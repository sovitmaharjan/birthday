<?php

function queryFilter($model, $condition)
{
    $result = $model->when(isset($condition['where_condition']), function ($q) use ($condition) {
        foreach ($condition['where_condition'] as $item) {
            if (strtotime($item['value'])) {
                $q->whereDate($item['column_name'], $item['value']);
            } else {
                $q->where($item['column_name'], $item['value']);
            }
        }
    })->when(isset($condition['search_keyword']), function ($q) use ($condition) {
        foreach ($condition['search_keyword'] as $item) {
            $q->where($item['column_name'], 'like', '%' . $item['value'] . '%');
        }
    })->when(isset($condition['operator_condition']), function ($q) use ($condition) {
        foreach ($condition['operator_condition'] as $item) {
            if (strtotime($item['value'])) {
                $q->whereDate($item['column_name'], $item['operator'], $item['value']);
            } else {
                $q->where($item['column_name'], $item['operator'], $item['value']);
            }
        }
    })->when(isset($condition['between_condition']), function ($q) use ($condition) {
        foreach ($condition['between_condition'] as $item) {
            $q->whereBetween($item['column_name'], $item['value']);
        }
    })->when(isset($condition['sort_condition']), function ($q) use ($condition) {
        foreach ($condition['sort_condition'] as $item) {
            $q->orderBy($item['column_name'], $item['value']);
        }
    });
    return $result;
}
