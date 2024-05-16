import Swal from "sweetalert2";

export default function show_alerta(msjTitulo,msjCuerpo,tipoalerta)
{
    Swal.fire(msjTitulo, msjCuerpo, tipoalerta);
}
