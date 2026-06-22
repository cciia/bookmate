import { Routes, Route, Navigate } from "react-router-dom";
import Login from "./pages/Login";
// import Register from "./pages/Register";

function App() {
  return (
    <Routes>
      {/* default langsung ke login */}
      <Route path="/" element={<Navigate to="/login" />} />

      {/* halaman login */}
      <Route path="/login" element={<Login />} />

      {/* register */}
      {/* <Route path="/register" element={<Register />} /> */}

       {/* dashboard */}
      <Route path="/dashboard" element={<h1>Dashboard BookMate</h1>} />
    </Routes>
  );
}

export default App;