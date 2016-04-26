<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Loja;
use App\Produto;
use Excel;

class ExcelController extends Controller
{
    protected $importCounts = [
        'lojas' => 0,
        'produtos' => 0,
    ];

    protected $errors = [];

    public function import($fileName)
    {
        $filePath = sprintf(
            '%s/%s',
            storage_path('exports'),
            $fileName
        );
        if (file_exists($filePath))
            Excel::load($fileName, function($reader) {
                $reader->ignoreEmpty();
                $all = array_filter($reader->all()->toArray());
                $currentLojaName = '';
                $currentLojaId = '';
                foreach($all as $k => $row) {
                    if ($row[0] === 'Loja')
                        $currentLojaName = $row[1];

                    elseif ($row[0] === 'Loja ID') {
                        $currentLojaId = $row[1];
                        /**
                         * Considerando que todos os .xlsx importados possuem
                         * a mesma estrutura da dados.
                         */
                        $loja = Loja::firstOrNew(['id' => $currentLojaId]);
                        $loja->name = $currentLojaName;
                        $loja->save();
                        ++$this->importCounts['lojas'];
                    }

                    elseif ($row[0] === 'Produtos' || $row[0] === 'ID')
                        continue;

                    else {
                        if ($this->validateRow($row)) {
                            $produto = Produto::firstOrNew(['id' => $row[0]]);
                            $produto->lojaId = $currentLojaId;
                            $produto->name = $row[1];
                            $produto->price = $row[2];
                            $produto->save();
                            ++$this->importCounts['produtos'];
                        }
                    }
                }
            });
        else
            $this->errors['file_not_exists'] = 'O arquivo solicitado não existe.';

        return view('excel.import', [
            'importCounts' => $this->importCounts,
            'errors' => $this->errors,
            'filePath' => $filePath,
        ]);
    }

    private function validateRow($row)
    {
        foreach($row as $cell) {
            if (empty($cell)) return false;
        }
        return true;
    }
}
