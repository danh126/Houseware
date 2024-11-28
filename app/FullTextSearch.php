<?php

namespace App;

trait FullTextSearch
{
    protected function fullTextWildcards($search)
    {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~']; // các ký tự đặc biệt

        $search = str_replace($reservedSymbols, '', $search); // loại bỏ các ký tự đặt biệt từ $search

        $words = explode(' ', $search); //tách từ trong $search dựa theo khảng cách

        foreach ($words as $key => $word) {
            //Nếu độ dài của từ lớn hơn hoặc = 3
            if (strlen($word) >= 3) {
                $words[$key] = "\"{$word}\""; // Thêm dấu ngoặc kép để tìm cụm từ chính xác trong BOOLEAN MODE
            }
        }

        return implode(' ', $words); //ghép từ lại thành 1 chuỗi và thêm khoảng trắng
    }

    public function scopeSearch($query, $search)
    {
        $columns = collect($this->searchable)->map(function ($column) {
            return $this->qualifyColumn($column);
        })->implode(',');

        $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($search));

        return $query;
    }
}
