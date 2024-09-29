--
-- PostgreSQL database dump
--

-- Dumped from database version 16.4 (Ubuntu 16.4-1.pgdg22.04+2)
-- Dumped by pg_dump version 16.4 (Ubuntu 16.4-1.pgdg22.04+2)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Create database abrahao
--

CREATE DATABASE abrahao;

-- Connect to the new database
\connect abrahao;

--
-- Name: pgcrypto; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;


--
-- Name: EXTENSION pgcrypto; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pgcrypto IS 'cryptographic functions';

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    email character varying(100) NOT NULL,
    password character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    name character varying(100)
);

ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;

--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);

--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, email, password, created_at, name) FROM stdin;
7	joao@mail.com	$2a$06$D158hSV58LWJqN7ldf.lW.MferhZCEIY5GDtzvraUkJfy.wZEW8B6	2024-09-26 00:07:22.813093	João Silva
8	maria@mail.com	$2a$06$O.h0TQcdYPw5bXrv2FoaquAlTwpoXoej9TVKdF.lmLO7rhykxQjzq	2024-09-26 00:07:22.813093	Maria Silva
9	abrahao@mail.com	$2a$06$tBsPHybiJYQOySiwxrnqqeebjqkc0/DYetrpgXHyIxk3EZKla89OK	2024-09-26 00:07:22.813093	Abrahao Eneias
10	lex@mail.com	$2y$10$Fv13e8qvIWckhgJ2kkg0YeO0BMZrZYW1nM6/dH.C6KgwYV7bYg9wC	2024-09-26 20:22:26.833226	Lex Lutor
11	castiglione@mail.com	$2y$10$5lT93EkhGxs5IFdjr5WnxemnnAAjZsVHW3QR8pR4Osqmk3QeVYfnK	2024-09-26 20:26:46.430724	Francis Castiglione
12	parker@mail.com	$2y$10$0K/LXngSGcPZ6zmpOj02YuCeBbvs23F0zXLu8.pi7dafDhFh3MFBe	2024-09-26 20:31:04.321273	Peter Parker
13	stark@mail.com	$2y$10$C4cmEvvvFnAUZZDkuDkCnu4YJhJJt7BFLoGJmd5FRwbCsKhPcA3tO	2024-09-26 20:35:23.628851	Tony Stark
14	summers@mail.com	$2y$10$d/5nBWtfWvsO180SZvnvUOV1v802GXtijgkRTOZgwjdWv9EVI5eem	2024-09-26 20:39:48.594956	Scott Summers
15	wanda@mail.com	$2y$10$cJqAVfQHB09Qs7XWla1lUud30oJWE0Hb9.cyO.jSbB3ceOQUy.EG.	2024-09-26 22:44:21.651818	Wanda Maximoff
16	marko@mail.com	$2y$10$hWGQgzScI6TB8H8UPovaMet77gP4qavfQE39hHYuV.RB0MtdXyFxy	2024-09-26 22:46:59.896397	Cain Marko
17	richards@mail.com	$2y$10$ynqhumWtlq1hbNLsa5Y2hengCIdQSnfDBH0c8w4CZj6X3JUAjMife	2024-09-26 22:50:58.639256	Reed Richards
18	raio@mail.com	$2y$10$f4yI6ivWYhCVEOdGrVYd..R4/XAG7Ls8.C9b3HEk/nBXLp1iQqFKy	2024-09-27 09:43:23.525917	Raio Negro
19	wayne@exemplo.com	$2y$10$DnH8onnJ5EDgIZKMczlcMeRN8zD4fFAED8/zH9TjpyxqJSPaFidqy	2024-09-28 10:07:53.508424	Bruce Wayne
20	diana@exemplo.com	$2y$10$HmqY0S3rSYRVpsPM.zG0FOHjAM0QIW023wIx1Xiis03TgsWod1JCW	2024-09-28 11:30:27.981433	Diana Prince
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 20, true);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--
