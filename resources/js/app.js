import "./bootstrap";

import Alpine from "alpinejs";

import "laravel-datatables-vite";

import { Notyf } from "notyf";
import "notyf/notyf.min.css";

window.notyf = new Notyf({
    duration: 3000,
    position: {
        x: "right",
        y: "top",
    },
});

window.Alpine = Alpine;

Alpine.start();
