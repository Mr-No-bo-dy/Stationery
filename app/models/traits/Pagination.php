<?php

namespace app\models\traits;

class Pagination
{
    public $totalItems;
    public $perPage;
    public $links;

    public function __construct(int $totalItems, int $perPage, int $links = 5)
    {
        $this->totalItems = $totalItems;
        $this->perPage = $perPage;
        $this->links = $links;
    }

    // Count total pages number
    public function countTotalPages(): int
    {
        return ceil($this->totalItems / $this->perPage);
    }

    // Get items per page
    public function getItemsPerPage(array $items, int $numPage): array
    {
        return array_slice($items, $this->perPage * ($numPage - 1), $this->perPage);
    }

    // Get pagination links
    public function getLinks(int $currentPage): array
    {
        $totalPages = $this->countTotalPages();
        $startLink = max(ceil($currentPage - ($this->links / 2)), 1);
        $endLink = min(ceil($currentPage + ($this->links / 2)) + 1, $totalPages);

        $links = [];
        if ($startLink > 1) {
            $links[] = [
                'page' => 1,
                'label' => '<<',
            ];
        }

        if ($currentPage > 1) {
            $links[] = [
                'page' => $currentPage - 1,
                'label' => '<',
            ];
        }

        for ($i = $startLink; $i <= $endLink; $i++) {
            $links[] = [
                'page' => $i,
                'label' => $i,
            ];
        }

        if ($currentPage < $totalPages) {
            $links[] = [
                'page' => $currentPage + 1,
                'label' => '>',
            ];
        }

        if ($endLink < $totalPages) {
            $links[] = [
                'page' => $totalPages,
                'label' => '>>',
            ];
        }

        return $links;
    }
}