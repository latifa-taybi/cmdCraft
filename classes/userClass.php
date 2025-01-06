<?php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUsers() {
        $stmt = $this->pdo->prepare("SELECT id_user, name, email FROM users WHERE role = 'client'");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function displayUsers() {
        $users = $this->getUsers();
        foreach ($users as $user) {
            echo "<tr>
                    <td># $user[id_user]</td>
                    <td>
                        <div class='client'>
                            <h4>$user[name]</h4>
                        </div>
                    </td>
                    <td>
                        <h4>$user[email]</h4>
                    </td>
                    <td>
                        <button type='submit' name='toggleAccount' class='toggle-btn'>
                            Activer
                        </button>
                    </td>
                </tr>";
        }
    }
}
?>
