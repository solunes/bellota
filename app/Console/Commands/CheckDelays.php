<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckDelays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-delays';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa si es que existen retrasos en el horario.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $day_id = date('N');
        $schedules = \App\PointSchedule::where('day_id', $day_id)->where('end_time', '>', $time)->where('initial_time', '<', $time)->orderBy('initial_time', 'ASC')->get();
        $this->info('Checkeo de retrasos comenzado.');
        $count = 0;
        foreach($schedules as $schedule){
            $missing_people = $schedule->point->assigned_staff-$schedule->actual_operators()->count();
            if($missing_people>0){
                $strtoinitial_time = strtotime($schedule->initial_time);
                $strtotime = strtotime($time);
                $diff = $strtotime-$strtoinitial_time;
                $delay = new \App\ScheduleDelay;
                $delay->point_id = $schedule->point_id;
                $delay->schedule_id = $schedule->id;
                $delay->missing_people = $missing_people;
                $delay->delay = round($diff/60);
                $delay->save();
                $count++;
            }
        }
        if($count>0){
            $to_array = ['edumejia30@gmail.com'];
            $message = 'Hubo un retraso en '.$count.' agencia(s). Por favor ingrese al sistema para más información: <a target="_blank" href="'.url('dashboard').'">Sistema de Totes</a>';
            \Func::make_email($to_array, 'Retraso en la Asistencia de Operarios', $message);
        }
        // NOTIFICAR POR CORREO A SUPERVISORES O JEFES?
        $this->info('Se crearon '.$count.' retrasos en los distintos horarios existentes.');
    }
}
