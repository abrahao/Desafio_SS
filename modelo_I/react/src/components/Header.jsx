const Header = () => {
  return (
    <header style={styles.header}>
      <h1 style={styles.title}>Minha Aplicação</h1>
    </header>
  );
};

const styles = {
  header: {
    backgroundColor: "#282c34",
    padding: "20px",
    color: "white",
    textAlign: "center",
  },
  title: {
    fontSize: "2rem",
  },
};

export default Header;
