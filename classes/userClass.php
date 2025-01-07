<?php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUsers() {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE role = 'client'");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUserId($id){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id_user = :id_user");
        $stmt->execute([
            'id_user'=>$id
        ]);
        return $stmt->fetch();
    }

    public function displayUsers() {
        $users = $this->getUsers();
        foreach ($users as $user) {
            if ($user['is_active'] == 1) {
                $avtivation = 'desactiver';
            } else {
                $avtivation = 'activer';
            }
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
                        <form action='../dashboard/toggleAccount.php?id={$user['id_user']}' method='POST'>
                            <input type='hidden' id='userId' name='userId' value='{$user['id_user']}'>
                            <button type='submit' name='toggleAccount' class='toggle-btn' id='active'>
                                $avtivation
                            </button>
                        </form>
                        <script>
                        </script>
                    </td>
                </tr>";
        }
    }

    public function countClient(){
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total_client FROM users WHERE role = 'client';");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total_client'];
    }

    public function accountManager($id_user){
        $stmt = $this->pdo->prepare("UPDATE users SET is_active = case WHEN (is_active) = 1 THEN 0 ELSE 1 END WHERE id_user = :id_user;");
        $stmt->execute([
            ':id_user'=>$id_user
        ]);
        return $stmt->fetch();
    }
}


?>


