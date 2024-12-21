<?php

if (!function_exists("get_skm_factor")) {
    function get_skm_factor(array $arr, int $index): float
    {
        if (count($arr) === 0) {
            return 0.0;
        }

        $reduced = array_reduce($arr, function ($acc, $item) use (&$index) {
            $acc[] = $item[$index];
            return $acc;
        });

        return number_format(array_sum($reduced) / count($reduced), 2, ".", "");
    }
}

if (!function_exists("get_skm_factor_per_row")) {
    function get_skm_factor_per_row($survey): array
    {
        $factor_indexes = [
            [19, 20], // persyaratan
            [1, 12, 13], // prosedur
            [10, 11, 17], // waktu pelayanan
            [18], // kompetensi
            [2], // sarana dan prasarana
            [9], // biaya
            [8, 14, 15, 16], // produk
            [3, 4, 5], // perilaku
            [6, 7], // penanganan aduan
        ];

        $survey = json_decode($survey, true);
        $respondent = [];
        foreach ($factor_indexes as $factor) {
            $tmp = [];
            foreach ($factor as $index) {
                if (!isset($survey[$index])) {
                    $tmp[] = 0;
                    continue;
                }

                $tmp[] = $survey[$index];
            }

            $avg = number_format(array_sum($tmp) / count($tmp), 2, ".", "");
            array_push($respondent, $avg);
        }

        return $respondent;
    }
}

if (!function_exists("get_skm_value")) {
    function get_skm_value(array $factors): float
    {
        return number_format(
            array_sum(
                array_reduce($factors, function ($acc, $item) {
                    $acc[] = $item * 0.11;
                    return $acc;
                })
            ) * 25,
            2
        );
    }
}

if (!function_exists("get_skm_predicate")) {
    function get_skm_predicate(string $value): string
    {
        $predicates = [
            "Tidak Baik" => [25.0, 64.99],
            "Kurang Baik" => [65.0, 76.6],
            "Baik" => [76.61, 88.3],
            "Kurang Baik" => [88.31, 100.0],
        ];

        foreach ($predicates as $key => $predicate) {
            if ($value >= $predicate[0] && $value <= $predicate[1]) {
                return $key;
            }
        }

        return "-";
    }
}

if (!function_exists("get_skm_performance")) {
    function get_skm_performance(float $value)
    {
        $performances = [
            "Tidak Baik" => [1.0, 2.5996],
            "Kurang Baik" => [2.6, 3.064],
            "Baik" => [3.0644, 3.532],
            "Kurang Baik" => [3.5324, 4.0],
        ];

        foreach ($performances as $key => $performance) {
            if ($value >= $performance[0] && $value <= $performance[1]) {
                return $key;
            }
        }

        return "-";
    }
}

if (!function_exists('filter_skm_result')) {
    function filter_skm_result($array, $key, $values) {
        return array_filter($array, function($v) use ($key, $values) {
            return in_array($v[$key], $values);
        });
    }
}

?>
