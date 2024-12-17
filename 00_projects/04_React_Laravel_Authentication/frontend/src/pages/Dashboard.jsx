import UserProfile from '../components/UserProfile';
import ChangePassword from '../components/ChangePassword';

const Dashboard = () => {

  return (
    <div className="container mt-5">
    <h1 className='text-center' style={{marginBottom: "40px"}}>Dashboard</h1>
    <div className="row">
      {/* User Details */}
      <div className="col-md-6">
        <UserProfile />
      </div>
      {/* Change Password Form */}
      <div className="col-md-6">
        <ChangePassword />
      </div>
    </div>
  </div>
);
};

export default Dashboard;
