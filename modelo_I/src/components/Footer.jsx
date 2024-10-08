const Footer = () => {
  return (
    <footer style={styles.footer}>
      <p>
        &copy; {new Date().getFullYear()} SS Digital. Todos os direitos
        reservados.
      </p>
    </footer>
  );
};

const styles = {
  footer: {
    backgroundColor: "#282c34",
    padding: "10px",
    color: "white",
    textAlign: "center",
    position: "fixed",
    bottom: 0,
    width: "100%",
  },
};

export default Footer;
