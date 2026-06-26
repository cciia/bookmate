import MainLayout from "../../layouts/MainLayout";

export default function Dashboard() {
  return (
    <MainLayout>
      <h1 className="text-2xl font-bold mb-6">
        Dashboard
      </h1>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <div className="bg-white p-5 rounded-lg shadow">
          <h3 className="text-gray-500">Total Books</h3>
          <p className="text-3xl font-bold">120</p>
        </div>

        <div className="bg-white p-5 rounded-lg shadow">
          <h3 className="text-gray-500">Members</h3>
          <p className="text-3xl font-bold">85</p>
        </div>

        <div className="bg-white p-5 rounded-lg shadow">
          <h3 className="text-gray-500">Borrowed</h3>
          <p className="text-3xl font-bold">34</p>
        </div>

        <div className="bg-white p-5 rounded-lg shadow">
          <h3 className="text-gray-500">Overdue</h3>
          <p className="text-3xl font-bold text-red-500">
            5
          </p>
        </div>

      </div>
    </MainLayout>
  );
}