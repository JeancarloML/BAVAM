<?php

class SideBar
{


    function SideBarShow($listaPrivilegios)
    {
        $numero_privilegios = count($listaPrivilegios);
?>
        <div class="d-flex flex-column flex-shrink-0 p-3 text-dark bg-white" style="flex-basis: 15%; border-right: 1px solid gray;">
            <ul class="nav nav-pills flex-column mb-auto">
                <?php
                for ($i = 0; $i < $numero_privilegios; $i++) {
                ?>
                    <li class="nav-item">
                        <form method="POST" action="<?php echo $listaPrivilegios[$i]['path'] ?>">
                            <input class="mb-2 btn-primary btn w-100" aria-current="page" type="submit" value="<?php echo $listaPrivilegios[$i]['label'] ?>" name="<?php echo $listaPrivilegios[$i]['name'] ?>">
                        </form>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
<?php
    }
}
?>