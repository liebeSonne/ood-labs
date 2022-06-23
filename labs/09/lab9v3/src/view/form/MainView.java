package view.form;

import controller.MainController;
import model.Document;

import javax.swing.*;

public class MainView extends JFrame {
    private JPanel mainPanel;
    private JPanel canvasPanel;
    private ToolbarView toolbarPanel;
    private Document document;

    private MainController controller;

    public MainView(Document document) {
        super();
        this.document = document;
        this.controller = new MainController(document);

        this.setContentPane(mainPanel);

        JMenuBar menuBar = new MenuView(document, (CanvasView)canvasPanel);
        setJMenuBar(menuBar);
    }

    private void createUIComponents() {
        canvasPanel = new CanvasView(document);
        toolbarPanel = new ToolbarView(document, (CanvasView)canvasPanel);
    }
}
