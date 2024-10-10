import { useState } from "react";
import PropTypes from "prop-types";

const Button = ({
  text = "Default Text",
  onClick,
  type = "button",
  disabled = false,
}) => {
  const [isHovered, setIsHovered] = useState(false);

  return (
    <button
      style={{
        ...styles.button,
        ...(isHovered ? styles.buttonHover : {}),
      }}
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
      onClick={onClick}
      type={type}
      disabled={disabled}
    >
      {text}
    </button>
  );
};

Button.propTypes = {
  text: PropTypes.string.isRequired,
  onClick: PropTypes.func.isRequired,
  type: PropTypes.oneOf(["button", "submit", "reset"]),
  disabled: PropTypes.bool,
};

const styles = {
  button: {
    backgroundColor: "#dc3545",
    border: "none",
    padding: "10px 20px",
    color: "#fff",
    borderRadius: "5px",
    fontSize: "1rem",
    cursor: "pointer",
    transition: "background-color 0.3s",
    width: "130px",
  },
  buttonHover: {
    backgroundColor: "#ff0e00",
  },
};

export default Button;
