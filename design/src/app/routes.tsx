import { createBrowserRouter } from "react-router";
import { Layout } from "./components/Layout";
import { Home } from "./pages/Home";
import { Fitur } from "./pages/Fitur";
import { UseCase } from "./pages/UseCase";
import { Analitik } from "./pages/Analitik";
import { Harga } from "./pages/Harga";

export const router = createBrowserRouter([
  {
    path: "/",
    Component: Layout,
    children: [
      { index: true, Component: Home },
      { path: "fitur", Component: Fitur },
      { path: "use-case", Component: UseCase },
      { path: "analitik", Component: Analitik },
      { path: "harga", Component: Harga },
    ],
  },
]);