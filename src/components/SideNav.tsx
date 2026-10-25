export default function SideNav() {
    return (
        <aside className="bg-gray-800 text-white p-4 w-64 h-screen">
            <h2 className="text-lg font-bold mb-4">Navigation</h2>
            <ul>
                <li className="mb-2">
                    <a href="#" className="hover:text-blue-400">Home</a>
                </li>
                <li className="mb-2">
                    <a href="#" className="hover:text-blue-400">Profile</a>
                </li>
                <li className="mb-2">
                    <a href="#" className="hover:text-blue-400">Settings</a>
                </li>
            </ul>
        </aside>
    );
}