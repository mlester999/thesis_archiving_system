<?php

namespace App\Exports;

use Spatie\Activitylog\Models\Activity;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;


class ActivityLogsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{

    private $activityLogsIDs;

    public function __construct($activityLogsIDs) {
        $this->activityLogsIDs = $activityLogsIDs;
    }

    public function headings(): array {
        return [
            'Log Name',
            'Description',
            'Department',
            'Research Agenda',
            'Student ID',
            'IP Address',
            'Created At'
        ];
    }

    public function map($activityLog): array {
        return [
            $activityLog->log_name,
            $activityLog->description,
            $activityLog->user->department->dept_name,
            $activityLog->properties->last(),
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

    public function registerEvents(): array {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:G1'; // All Headers

                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);

                $event->sheet->getDelegate()->getPageSetup()
                ->setPaperSize(PageSetup::PAPERSIZE_A4)
                ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE)
                ->setFitToWidth(1)
                ->setFitToHeight(0); 

                $event->sheet->getDelegate()->getPageMargins()
                ->setTop(1)
                ->setRight(0.75)
                ->setLeft(0.75)
                ->setBottom(1);
            }
        ];
    }
}
