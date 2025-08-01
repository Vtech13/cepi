<?php

namespace App\Enums;

class PatientStatus
{
    const DEMANDE_RECUE = 'demande_recue';
    const PATIENT_CONTACTER = 'patient_contacter';
    const PREMIERE_CONSULT = 'premiere_consultation';
    const DIAGNOSTIC = 'diagnostic';
    const INTERVENTION = 'intervention';
    const CONTROL_8_DAYS = 'control_8_jours';
    const CONTROL_3_MONTH = 'control_3_mois';
    const REVOIR_PATIENT = 'revoir_patient_suite';

    const STATUSES = [
        self::DEMANDE_RECUE     => 'Demande reçue',
        self::PATIENT_CONTACTER => 'Patient contacté',
        self::PREMIERE_CONSULT  => 'Première consultation',
        self::DIAGNOSTIC        => 'Diagnostic',
        self::INTERVENTION      => 'Intervention',
        self::CONTROL_8_DAYS    => 'Contrôle 8 jours',
        self::CONTROL_3_MONTH   => 'Contrôle 3 mois',
        self::REVOIR_PATIENT    => 'Vous pouvez revoir le patient pour la suite des soins'
    ];
}
