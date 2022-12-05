<?php

namespace App\Exports;

use Spatie\Activitylog\Models\Activity;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ActivityLogsExport implements FromCollection, WithHeadings, WithMapping
{

    private $activityLogsIDs;

    public function __construct($activityLogsIDs) {
        $this->activityLogsIDs = $activityLogsIDs;
    }

    public function headings(): array {
        return [
            'Log Name',
            'Description',
            'Student ID',
            'IP Address',
            'Created At'
        ];
    }

    public function map($activityLog): array {
        return [
            $activityLog->log_name,
            $activityLog->description,
            $activityLog->user->student_id,
            $activityLog->properties->first(),
            $activityLog->created_at,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection() {
        return Activity::all()->find($this->activityLogsIDs);
    }
}
