import SideNav from './SideNav';

function PHeadScreen() {
  return (
    <>
    </>
  )
}

function LecturerScreen() {
  return (
    <>
    </>
  )
}
function StudentScreen() {
 return (
   <>
   </>
 )
}

export default function Dashboard({ role }: { role: number }) {
  let content;
  switch (role) {
    case 1: 
      content =  <PHeadScreen />;
      break;
    case 2:
      content = <LecturerScreen />;
      break;
    case 3:
      content = <StudentScreen />;
      break;
    default:
      console.error("Role is not recognized by the system. Please check the user profile with the university administrator or contact support.");
  }

  return (
    <>
    <SideNav /> + {content}
    </>
  )
}