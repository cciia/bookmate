import React, { useState } from 'react';
import {HiOutlineMagnifyingGlass, HiOutlineBell, HiOutlineChevronDown, HiOutlineUser, HiOutlineCog6Tooth, HiOutlineArrowRightOnRectangle, HiOutlineBars3,} from 'react-icons/hi2';

const Topbar = ({
  pageTitle = 'Dashboard',
  breadcrumbs = [],
  sidebarOpen,
  setSidebarOpen,
}) => {
  const [profileDropdownOpen, setProfileDropdownOpen] = useState(false);
  const [searchQuery, setSearchQuery] = useState('');

  const handleProfileClick = () => {
    setProfileDropdownOpen(!profileDropdownOpen);
  };

  return (
    <>
      <div className={`fixed top-0 right-0 h-16 bg-white border-b border-gray-200 flex items-center px-8 gap-6 z-40 transition-all duration-300 ${sidebarOpen ? 'left-64' : 'left-0'}`}>
        <div className="flex-1 flex items-center gap-3 min-w-0">
          <button
            onClick={() => setSidebarOpen(!sidebarOpen)}
            className="p-2 rounded-md hover:bg-gray-100 transition-colors">
            <HiOutlineBars3 className="w-5 h-5" />
          </button>
          {breadcrumbs.length > 0 && (
            <div className="flex items-center gap-2 text-sm text-gray-500 min-w-0">
              {breadcrumbs.map((crumb, index) => (
                <div key={index} className="flex items-center gap-2 min-w-0">
                  {index > 0 && <span className="text-gray-300">/</span>}
                  <span className="truncate hover:text-gray-700 cursor-pointer transition-colors">
                    {crumb}
                  </span>
                </div>
              ))}
              <span className="text-gray-300">/</span>
            </div>
          )}
          <h2 className="text-base font-semibold text-gray-900 truncate">
            {pageTitle}
          </h2>
        </div>
        <div className="flex-1 max-w-md">
          <div className="relative">
            <HiOutlineMagnifyingGlass className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
            <input
              type="text"
              placeholder="Search..."
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              className="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:bg-white focus:border-gray-300 transition-colors"
            />
          </div>
        </div>
        <div className="flex items-center gap-4">
          <button className="relative text-gray-600 hover:text-gray-900 transition-colors p-1.5 hover:bg-gray-50 rounded-md">
            <HiOutlineBell className="w-5 h-5" />
            <span className="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
          </button>
          <div className="w-px h-6 bg-gray-200"></div>
          {/*profil*/}
          <div className="relative">
            <button
              onClick={handleProfileClick}
              className="flex items-center gap-2 px-3 py-1.5 text-gray-600 hover:bg-gray-50 rounded-md transition-colors">
              <div className="flex items-center gap-2 min-w-0">
                <div className="flex flex-col items-end min-w-0">
                  <span className="text-sm font-medium text-gray-900 truncate">
                    John Doe
                  </span>
                  <span className="text-xs text-gray-500">Librarian</span>
                </div>
                <div className="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center shrink-0">
                  <span className="text-sm font-semibold text-gray-600">JD</span>
                </div>
              </div>
              <HiOutlineChevronDown
                className={`w-4 h-4 text-gray-400 shrink-0 transition-transform ${
                  profileDropdownOpen ? 'rotate-180' : ''
                }`}/>
            </button>
            {/*dropdown*/}
            {profileDropdownOpen && (
              <div className="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1 z-50">
                <div className="px-4 py-2 border-b border-gray-100">
                  <p className="text-sm font-medium text-gray-900">John Doe</p>
                  <p className="text-xs text-gray-500">john.doe@bookmate.com</p>
                </div>
                <button className="w-full flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors text-left">
                  <HiOutlineUser className="w-4 h-4 shrink-0" />
                  <span>Profile</span>
                </button>
                <button className="w-full flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors text-left">
                  <HiOutlineCog6Tooth className="w-4 h-4 shrink-0" />
                  <span>Settings</span>
                </button>
                <div className="border-t border-gray-100 my-1"></div>
                <button className="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                  <HiOutlineArrowRightOnRectangle className="w-4 h-4 shrink-0" />
                  <span>Sign Out</span>
                </button>
              </div>
            )}
          </div>
        </div>
      </div>
      <div className="h-16"></div>
    </>
  );
};

export default Topbar;