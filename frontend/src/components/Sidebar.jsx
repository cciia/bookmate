import React, { useState } from 'react';
import {HiOutlineHome, HiOutlineBookOpen, HiOutlineUser, HiOutlineBuildingOffice2, HiOutlineSquares2X2, HiOutlineUsers, HiOutlineArrowUpTray, HiOutlineArrowDownTray, HiOutlineChartBar, HiOutlineCog6Tooth, HiOutlineChevronDown} from 'react-icons/hi2';

const Sidebar = ({activeMenu = 'dashboard', sidebarOpen,}) => {
  const [expandedSection, setExpandedSection] = useState(null);

  const menuItems = [
    { id: 'dashboard', label: 'Dashboard', icon: HiOutlineHome },
    { id: 'books', label: 'Books', icon: HiOutlineBookOpen },
    { id: 'authors', label: 'Authors', icon: HiOutlineUser },
    { id: 'publishers', label: 'Publishers', icon: HiOutlineBuildingOffice2 },
    { id: 'categories', label: 'Categories', icon: HiOutlineSquares2X2 },
  ];

  const transactionItems = [
    { id: 'members', label: 'Members', icon: HiOutlineUsers },
    { id: 'borrowing', label: 'Borrowing', icon: HiOutlineArrowDownTray },
    { id: 'returning', label: 'Returning', icon: HiOutlineArrowUpTray },
  ];

  const adminItems = [
    { id: 'reports', label: 'Reports', icon: HiOutlineChartBar },
    { id: 'settings', label: 'Settings', icon: HiOutlineCog6Tooth },
  ];

  const MenuItem = ({ item, isActive }) => {
    const IconComponent = item.icon;

    return (
      <button
        className={`w-full flex items-center gap-3 px-3 py-2.5 rounded-md transition-colors text-sm font-medium ${
          isActive
            ? 'bg-gray-100 text-gray-900'
            : 'text-gray-600 hover:bg-gray-50'
        }`}>
        <IconComponent className="w-5 h-5 shrink-0" />
        <span className="truncate">{item.label}</span>
      </button>
    );
  };
  const SectionHeader = ({ title, subsection }) => {
    return (
      <div className="flex items-center justify-between px-3 py-3 mt-4 first:mt-0">
        <h3 className="text-xs font-semibold text-gray-400 uppercase tracking-wider">
          {title}
        </h3>
        {subsection && (
          <button
            onClick={() =>
              setExpandedSection(
                expandedSection === subsection ? null : subsection
              )
            }
            className="text-gray-400 hover:text-gray-600">
            <HiOutlineChevronDown
              className={`w-4 h-4 transition-transform ${
                expandedSection === subsection ? 'rotate-180' : ''
              }`}/>
          </button>
        )}
      </div>
    );
  };
  return (
    <aside
      className={`fixed left-0 top-0 h-screen w-64 bg-white border-r border-gray-200 flex flex-col overflow-y-auto transition-all duration-300 z-50 ${
        sidebarOpen
          ? 'translate-x-0'
          : '-translate-x-full'
      }`}>
      {/*logo*/}
      <div className="flex items-center gap-3 px-6 py-6 border-b border-gray-200">
        <div className="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
          <span className="text-white font-bold text-sm">BM</span>
        </div>
        <div className="flex-1 min-w-0">
          <h1 className="text-base font-bold text-gray-900">
            BookMate
          </h1>
          <p className="text-xs text-gray-500">
            Library System
          </p>
        </div>
      </div>
      {/*nav*/}
      <nav className="flex-1 px-4 py-4 space-y-1">
        <SectionHeader title="Main" />
        <div className="space-y-1">
          {menuItems.map((item) => (
            <MenuItem
              key={item.id}
              item={item}
              isActive={activeMenu === item.id}/>
          ))}
        </div>
        <SectionHeader
          title="Transactions"
          subsection="transactions"/>
        <div className="space-y-1">
          {transactionItems.map((item) => (
            <MenuItem
              key={item.id}
              item={item}
              isActive={activeMenu === item.id}/>
          ))}
        </div>
        <SectionHeader
          title="Admin"
          subsection="admin"/>
        <div className="space-y-1">
          {adminItems.map((item) => (
            <MenuItem
              key={item.id}
              item={item}
              isActive={activeMenu === item.id}/>
          ))}
        </div>
      </nav>
      {/*footer*/}
      <div className="px-4 py-4 border-t border-gray-200">
        <div className="text-xs text-gray-500 space-y-1">
          <p className="font-semibold text-gray-600">
            BookMate v1.0
          </p>
          <p>Library Management System</p>
        </div>
      </div>
    </aside>
  );
};
export default Sidebar;