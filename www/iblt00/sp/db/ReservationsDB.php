<?php require __DIR__ . '/Database.php'; ?>
<?php

class UserDB extends Database
{
    protected $tableName = 'sp_reservations';
    public function create($data)
    {
        $sql = "INSERT INTO $this->tableName (created, start, end, created_by, patient_name, patient_surname, state, state_changed_by, md_type, term_type, specification, worker, block_reservations) VALUES (:created, :start, :end, :createdBy, :patientName, :patientSurname, :state, :stateChangedBy, :mdType, :termType, :comment, :worker, :blockReservations)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'created' => $data['created'],
            'start' => $data['start'],
            'end' => $data['end'],
            'createdBy' => $data['createdBy'],
            'patientName' => $data['patientName'],
            'patientSurname' => $data['patientSurname'],
            'state' => $data['state'],
            'stateChangedBy' => $data['stateChangedBy'],
            'mdType' => $data['mdType'],
            'termType' => $data['termType'],
            'comment' => $data['comment'],
            'worker' => $data['worker'],
            'blockReservations' => $data['blockReservations'],
        ]);
    }
    public function findByState($resState)
    {
        return $this->fetchBy('state', $resState);
    }
    public function findByWorker($resWorker)
    {
        return $this->fetchBy('worker', $resWorker);
    }
    //TODO date findby dates (created, starting, ending + between)
}

?>