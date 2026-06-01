<?php
use PHPUnit\Framework\TestCase;
use App\Catalog;

class CatalogTest extends TestCase {
    private $katalog;
    private $testFile = __DIR__ . '/test_products.json';

    // Dipanggil SEBELUM setiap test run
    protected function setUp(): void {
        $dummyData = [
            "PRD-1" => [
                "nama" => "Kemeja Flanel", 
                "harga" => 150000, 
                "stok" => 10
            ]
        ];
        file_put_contents($this->testFile, json_encode($dummyData));
        $this->katalog = new Catalog($this->testFile);
    }

    // Test Case 1: Pencarian Ditemukan (UT-01)
    public function testSearchProductFound() {
        $result = $this->katalog->searchProduct("Kemeja");
        $this->assertCount(1, $result);
    }

    // Test Case 2: Pencarian Kosong (UT-02)
    public function testSearchProductEmptyKeyword() {
        $result = $this->katalog->searchProduct("");
        $this->assertNotEmpty($result);
    }

    // Dipanggil SETELAH setiap test run untuk bersih-bersih
    protected function tearDown(): void { 
        if (file_exists($this->testFile)) {
            unlink($this->testFile); 
        }
    }
}