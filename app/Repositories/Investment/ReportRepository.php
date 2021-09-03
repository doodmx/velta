<?php

namespace App\Repositories\Investment;

use App\Exceptions\Helpers\DatabaseException;
use App\Interfaces\Helpers\StorageInterface;
use App\Models\Investment\Report;
use App\Interfaces\Investment\ReportInterface;
use Illuminate\Database\QueryException;

class ReportRepository implements ReportInterface
{

    private $report;
    private $storage;

    public function __construct(StorageInterface $storageContract)
    {
        $this->storage = $storageContract;
        $this->report = app()->make(Report::class);
    }

    public function paginate($investmentId)
    {
        $reports = $this->report
            ->where('investment_id', $investmentId);

        return $reports;
    }


    public function create($data)
    {
        try {
            $file = $this->storage->save('users/' . $data['user_id'] . '/reports/', request()->file('file'));

            $report = $this->report->create([
                'investment_id' => $data['investment_id'],
                'file' => $file,
                'note' => $data['note'],
            ]);

            return $report;
        } catch (QueryException $e) {
            throw new DatabaseException('Hubo un error al guardar el reporte, intenta nuevamente');
        }
    }


    public function delete($id)
    {
        try {
            $report = $this->report->find($id);
            $this->storage->delete($report->file);
            $report->delete();

            return $report;
        } catch (QueryException $e) {
            throw new DatabaseException('Hubo un error al eliminar el reporte, intenta nuevamente');
        }
    }

}
