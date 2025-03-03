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

    // count pages number
    public function countTotalPages(): int
    {
        return ceil($this->totalItems / $this->perPage);
    }

    // get items per page
    public function getItemsPerPage(array $items, int $numPage): array
    {
        return array_slice($items, $this->perPage * ($numPage - 1), $this->perPage);
    }

    public function getLinks(int $currentPage): array
    {
        $countPage = $this->countTotalPages();
        $startLink = max(ceil($currentPage - ($this->links / 2)), 1);
        $endLink = ceil($currentPage + ($this->links / 2)) + 1;
        $links = [];
        if ($startLink > 1) {
            $links[] = [
                "page" => 1,
                "label" => "<<",
            ];
        }

        if ($currentPage > 1) {
            $links[] = [
                "page" => $currentPage - 1,
                "label" => "<",
            ];
        }

        if ($currentPage < $countPage) {
            $links[] = [
                "page" => $currentPage + 1,
                "label" => ">",
            ];
        }

        if ($countPage > $endLink) {
            $links[] = [
                "page" => $endLink,
                "label" => ">>",
            ];
        }
    }
}