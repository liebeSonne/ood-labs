package view.form;

import controller.MainController;
import model.Document;
import model.SelectionModel;

import javax.swing.*;

public class MainView extends JFrame {
    private JPanel mainPanel;
    private JPanel canvasPanel;
    private ToolbarView toolbarPanel;
    private Document document;

    private MainController controller;

    private SelectionModel selectionModel;

    public MainView(Document document) {
        super();
        this.document = document;
        this.controller = new MainController(document);

        this.setContentPane(mainPanel);

        JMenuBar menuBar = new MenuView(document, (CanvasView)canvasPanel, selectionModel);
        setJMenuBar(menuBar);
    }

    private void createUIComponents() {
        this.selectionModel = new SelectionModel();
        canvasPanel = new CanvasView(document, selectionModel);
        toolbarPanel = new ToolbarView(document, (CanvasView)canvasPanel);
    }
}
